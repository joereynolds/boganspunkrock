provider "aws" {
  profile = "personal-account"
  region  = "eu-west-2"
}

terraform {
  backend "s3" {
    bucket = "bogans-terraform-state-bucket"
    key = "global/s3/terraform.tfstate"
    region = "eu-west-2"

    dynamodb_table = "bogans-terraform-lock-db"
    encrypt = true
  }
}

## Created manually, kept here for reference
## resource "aws_s3_bucket" "bogans_terraform_state_bucket" {
##   bucket = "bogans-terraform-state-bucket"
##
##   versioning {
##     enabled = true
##   }
##
##   server_side_encryption_configuration {
##     rule {
##       apply_server_side_encryption_by_default {
##         sse_algorithm = "AES256"
##       }
##     }
##   }
## }

resource "aws_dynamodb_table" "bogans_terraform_lock_db" {
  name = "bogans-terraform-lock-db"
  billing_mode = "PAY_PER_REQUEST"
  hash_key = "LockID"

  attribute {
    name = "LockID"
    type = "S"
  }
}

resource "aws_s3_bucket" "bogans_bucket" {
  bucket = "bogans-storage-bucket"
}

resource "aws_s3_bucket_object" "object" {
  bucket = "${aws_s3_bucket.bogans_bucket.id}"
  key    = "images/"
}
