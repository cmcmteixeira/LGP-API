<?php
/**
 * Created by IntelliJ IDEA.
 * User: carlos
 * Date: 15/04/2015
 * Time: 18:07
 */

namespace AppBundle\Service\FileSystem;


use AppBundle\Document\File\File;
use AppBundle\Service\FileSystem\FileType\AbstractFile;
use AppBundle\Service\FileSystem\FileType\FolderFile;
use AppBundle\Service\FileSystem\FileType\RarFile;
use AppBundle\Service\FileSystem\FileType\RegularFile;
use AppBundle\Service\FileSystem\FileType\ZipFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileFactory {
    const ZIP = "zip";
    const RAR = "rar";
    const DIR = "__DIR__";
    const REGULAR= "__REG__";
    private $fs;
    private $tmpDir;

    public function __construct($provider,$tmpDir){
        $this->fs = $provider;
        $this->tmpDir = $tmpDir;
    }

    public function get($path,$extension=FileFactory::REGULAR){
        switch($extension){
            case FileFactory::ZIP :
                $fileObj = new ZipFile($path,$this->fs,$this->tmpDir);
                break;
            case FileFactory::RAR :
                $fileObj = new RarFile($path,$this->fs,$this->tmpDir);
                break;
            case FileFactory::DIR :
                $fileObj = new FolderFile($path,$this->fs,$this->tmpDir);
                break;
            default:
                $fileObj = new RegularFile($path,$this->fs,$this->tmpDir);
                break;
        }
        return $fileObj;
    }


    /**
     * @param UploadedFile $file
     * @return AbstractFile
     */
    public function getByUploadedFile(UploadedFile $file){

        return $this->get($file->getPathname(),$file->guessClientExtension());
    }



}