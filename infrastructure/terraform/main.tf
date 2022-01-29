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

resource "aws_dynamodb_table" "bogans_terraform_test_table" {
  name = "bogans-terraform-test-table"
  billing_mode = "PAY_PER_REQUEST"
  hash_key = "UserId"

  attribute {
    name = "UserId"
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

resource "aws_s3_bucket_object" "object_2" {
  bucket = "${aws_s3_bucket.bogans_bucket.id}"
  key    = "images/outpost-2021-10-02/"
}

resource "aws_s3_bucket_object" "object_3" {
  bucket = "${aws_s3_bucket.bogans_bucket.id}"
  key    = "images/promo/"
}

resource "aws_s3_bucket_object" "object_4" {
  bucket = "${aws_s3_bucket.bogans_bucket.id}"
  key    = "images/doc/"
}

resource "aws_cloudfront_distribution" "tfer--E37FB4DVUDZZ7L" {
  comment = "Cloudfront distribution for our bogans bucket"

  default_cache_behavior {
    allowed_methods = ["HEAD", "GET"]
    cached_methods  = ["GET", "HEAD"]
    compress        = "false"
    default_ttl     = "86400"

    forwarded_values {
      cookies {
        forward = "none"
      }

      headers      = ["Origin"]
      query_string = "false"
    }

    max_ttl                = "31536000"
    min_ttl                = "86400"
    smooth_streaming       = "false"
    target_origin_id       = "s3-origin-bogans-storage-bucket"
    viewer_protocol_policy = "redirect-to-https"
  }

  default_root_object = "index.html"
  enabled             = "true"
  http_version        = "http1.1"
  is_ipv6_enabled     = "false"

  origin {
    connection_attempts = "3"
    connection_timeout  = "10"
    domain_name         = "bogans-storage-bucket.s3.amazonaws.com"
    origin_id           = "s3-origin-bogans-storage-bucket"

    s3_origin_config {
      origin_access_identity = "origin-access-identity/cloudfront/E1TZ8NWAH7ME2N"
    }
  }

  price_class = "PriceClass_All"

  restrictions {
    geo_restriction {
      restriction_type = "none"
    }
  }

  retain_on_delete = "false"

  viewer_certificate {
    cloudfront_default_certificate = "true"
    minimum_protocol_version       = "TLSv1"
  }
}
