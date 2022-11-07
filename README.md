# Upload file image

Upload file from command line. 

### How it works

Uploaded file is saved in to the local server (public/image), next is resized to 150px and at the end is send to Cloud (in my example to DropBox).

### Install

```bash
composer i
```

### How start

```bash
php bin/console app:upload-file [path_file]
# example
php bin/console app:upload-file /home/damian/Pictures/green.jpg
```

## Unit test

```bash
vendor/bin/phpunit
```



