
## structure 



src/
    Command/
        UploadFileCommand.php
            execute(path) :
                try
                    UploadService->uploadImage(path)
    Dto/
        ImageDto.php
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

        UploadService.php
        
            upload(UploadFileInterface uploadFile, File file) :
                uploadFile->upload(file)
            uploadImage(path) :
                image = ImageDto()
                image->file = new File(path)
                
                image = ImageService::resize(image->file, size)

                dropBox = DropBoxService
                this->upload(dropBox, image->getFile())
