<?php

namespace App\Http\Services;

use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Upload
{
    private const safeExtensions = ['jpg', 'jpeg', 'png', 'zip', 'pdf'];
    private const defaultPath    = "uploads/";
    private const corePath    = "../../public_html/";

    /**
     * Uploads a base64-encoded file to the specified storage directory.
     *
     * @param $request
     * @param string $baseStorage The base storage directory.
     * @return string The path to the uploaded file.
     * @throws Exception If the file type is invalid or the file cannot be uploaded.
     */
    public static function uploadBase64OnFile($request, string $baseStorage = self::defaultPath): string
    {
        $extension = explode('/', mime_content_type($request->upload))[1];
        $file      = base64_decode(preg_replace('#data:[^;]+;base64,#', '', $request->upload));

        if (!in_array($extension, self::safeExtensions, true)) {
            // File extension is not safe, throw an exception
            throw new Exception('Invalid file type');
        }

        if (isset($request->customer_id))
            $folder   = (Customer::where("id",$request->customer_id)->first())['national_code'];
        else
            $folder   = (User::where("id",auth()->id())->first())['id'];


        $fileName = "/" . Str::random(10) . time() . "." . $extension;


        // Create the directory if it doesn't exist
        if (!File::isDirectory(public_path( self::corePath . $baseStorage .  $folder))) {
            File::makeDirectory(public_path( self::corePath . $baseStorage . $folder), 0777, true, true);
        }

        // Attempt to store the file
        if (!File::put(public_path( self::corePath . $baseStorage .  $folder) . $fileName, $file)) {
            throw new Exception('Failed to upload file');
        }

        return $baseStorage . $folder . $fileName;
    }

    /**
     * Retrieves the MIME type of base64-encoded file.
     *
     * @param string $base64Input The base64-encoded file data.
     * @return string|bool The MIME type of the file, or false on failure.
     */
    public static function base64MimeType(string $base64Input): bool|string
    {
        return finfo_buffer(finfo_open(), base64_decode($base64Input), FILEINFO_MIME_TYPE);
    }

    /**
     * Retrieves the file extension based on the MIME type.
     *
     * @param string $mimeType The MIME type of the file.
     * @return string The file extension.
     */
    public static function getExtensionFromMimeType(string $mimeType): string
    {
        // Define the mapping of file extensions to MIME types
        $extensionMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/zip' => 'zip',
        ];

        return $extensionMap[$mimeType] ?? 'file';
    }
}
