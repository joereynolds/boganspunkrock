# Bogans

The source code for [bogansband.com](bogansband.com) (Not currently live, be patient)

## Installing

1. Clone the repository and run `./run.sh`

If you want some fixture data, run `./after.sh` once the containers are up

## Infrastructure

(Most) infrastructure is managed via Terraform.

Digital ocean is the VPS and AWS S3 for storage.


```
cd infrastructure/terraform
terraform init

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
