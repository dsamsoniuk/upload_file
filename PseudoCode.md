
## structure 



src/
    Command/
        UploadFileCommand.php
            execute(path) :
                try
                    FileService->uploadImage(path)
    Dto/
        Image.php
            public file

    Service/
    
        Interface/
            UploadFileInterface.php
                upload(File) :

        DropBoxService.php implements UploadFileInterface
            upload(File) : void

        ImageService.php
            isImage(File file) : boolen
            resize(File file, size) : File

        FileService.php
        
            upload(UploadFileInterface uploadFile, File file) :
                uploadFile->upload(file)
            uploadImage(path, size = 'S') :
                image = Image(path)
                
                image = ImageService::resize(image->file, size)

                dropBox = DropBoxService
                this->upload(dropBox, image->getFile())
