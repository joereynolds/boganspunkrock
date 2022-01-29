# Bogans

The source code for [bogansband.com](bogansband.com) (Not currently live, be patient)

## Installing

1. Clone the repository and run `./run.sh`

If you want some fixture data, run `./after.sh` once the containers are up

## Infrastructure

(Most) infrastructure is managed via Terraform.

Digital ocean is the VPS and AWS S3 for storage. S3 sits behind Cloudfront which we use so we don't hammer S3.


```
cd infrastructure/terraform
terraform init -backend-config="access_key=your-key" -backend-config="secret_key=your-key"


... Do your changes

terraform plan
terraform apply
```

### Uploading files to s3

The easiest way is with the CLI

(Remember to specify `--profile personal-account` if you're on a machine with multiple AWS accounts)
```
aws s3 cp your-file.png s3://bogans-storage-bucket/images/
```
