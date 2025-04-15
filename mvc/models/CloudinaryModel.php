<?php
require_once __DIR__ . 'vendor/autoload.php';

use Dotenv\Dotenv;
use Cloudinary\Cloudinary;

class CloudinaryModel extends Database{
    private $cloudinary;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
                'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function uploadImage($filePath) {
        return $this->cloudinary->uploadApi()->upload($filePath);
    }
}
