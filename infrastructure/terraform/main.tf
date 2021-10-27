provider "aws" {
  profile = "personal-account"
  region  = "eu-west-2"
}

resource "aws_s3_bucket" "bogans_bucket" {
  bucket = "bogans-storage-bucket"
}

resource "aws_s3_bucket_object" "object" {
  bucket = "${aws_s3_bucket.bogans_bucket.id}"
  key    = "images/"
}
