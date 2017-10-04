# jwt

Creating a keys.

openssl genrsa -out mykey 1024

Generate a .pem

openssl rsa -in mykey -pubout -out pubkey.pem
