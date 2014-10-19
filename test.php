<?php

$str = '{
"cloudProvider": "amazon aws",
"secretKey": "M0ZctIazwP3d/IeEH7tcXz+0H65UlSPObm+qDIFW",
"apiKey": "AKIAJJU757D6B6JHVU7Q",
"packageName": "xdocker/securitymonkey",
"dockerParams": {"ports": [443, 5000], "env": {"host": "{host}", "AWS_ACCESS_KEY_ID":"{AWS_ACCESS_KEY_ID}","AWS_SECRET_ACCESS_KEY":"{AWS_SECRET_ACCESS_KEY}"}, "tag": "v1",
            "cmd": "/home/ubuntu/securitymonkey.sh"},
"amazonIAM": [
  {
    "ruleName": "SecurityMonkeyInstanceProfile", "policyName": "SecurityMonkeyLaunchPerms", "instanceProfile": "SecurityMonkey",
"policy": "{\"Version\": \"2012-10-17\", \"Statement\": [{\"Action\": [\"ses:SendEmail\"], \"Resource\": \"*\", \"Effect\": \"Allow\"}, {\"Action\": \"sts:AssumeRole\", \"Resource\": \"*\", \"Effect\": \"Allow\"}]}"
},
  {
        "ruleName": "SecurityMonkey", "policyName": "SecurityMonkeyReadOnly",
    "policy":  "{\"Statement\": [{\"Action\": [\"cloudwatch:Describe*\", \"cloudwatch:Get*\", \"cloudwatch:List*\", \"ec2:Describe*\", \"elasticloadbalancing:Describe*\", \"iam:List*\", \"iam:Get*\", \"route53:Get*\", \"route53:List*\", \"rds:Describe*\", \"s3:Get*\", \"s3:List*\", \"sdb:GetAttributes\", \"sdb:List*\", \"sdb:Select*\", \"ses:Get*\", \"ses:List*\", \"sns:Get*\", \"sns:List*\", \"sqs:GetQueueAttributes\", \"sqs:ListQueues\", \"sqs:ReceiveMessage\"], \"Resource\": \"*\", \"Effect\": \"Allow\"}]}",
    "assumePolicy": "{\"Version\": \"2008-10-17\", \"Statement\": [{\"Action\": \"sts:AssumeRole\", \"Principal\": {\"AWS\": \"{SecurityMonkeyInstanceProfile}\"}, \"Effect\": \"Allow\", \"Sid\": \"\"}]}"

  }
],


"OS": "Ubuntu 14.04",
    "token": "WyJ0ZXN0MzMiLCIwOThmNmJjZDQ2MjFkMzczY2FkZTRlODMyNjI3YjRmNiJd.Bx_pAA.7SQuZf4QS49w1xLMImMxTfbP3Lk"
}';
print_r(json_decode($str));
