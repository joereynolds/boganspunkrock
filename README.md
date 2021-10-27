# Bogans

The source code for [bogansband.com](bogansband.com) (Not currently live, be patient)

## Installing

1. Clone the repository

2. Install required packages
```
docker run --rm --interactive --tty --volume $PWD:/app composer install
```

## Infrastructure

(Most) infrastructure is managed via Terraform.

Digital ocean is the VPS and AWS S3 for storage.

```
terraform plan
terraform apply
```

### Uploading files to s3

The easiest way is with the CLI

(Remember to specify `--profile personal-account` if you're on a machine with multiple AWS accounts)
```
aws s3 cp your-file.png s3://bogans-storage-bucket/images/
```





