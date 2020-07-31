my implementation of the https://github.com/printify/printify-backend-homework

how to run:

* clone
* run `docker build --tag whatever2 .&&docker run --publish 8000:8000 --name whatever2 whatever2&&docker rm whatever2` (I hope you have Linux(ish) and Docker)
* it's alive at http://localhost:8000
* ^C when done

API:

* create user
```
curl -X POST http://localhost:8000/user
```
* get specific user info (id and balance)
```
curl -X GET http://localhost:8000/user/2 # ← user id at the end. 2 is predefined
```
* get list of items with prices and SKUs
```
curl -X GET http://localhost:8000/items
```
* order items (provide SKUs from ↑)
```
curl -X POST \
  http://localhost:8000/order \
  -d '{
    "user": 2,
    "items": [
        {
            "sku": "c75ba722-4ad6-4fc3-afd1-ab88c0cf2b69",
            "quantity": 1
        },
        {
            "sku": "c5a79049-c6ac-4f9f-9005-01824cfd45fc",
            "quantity": 2
        }
    ],
    "shippingInfo": {
        "country": "nonUS",
        "city": "dfsdf",
        "address": "asdffd",
        "phone": "asdf",
        "name": "asdfasdf",
        "state": "asdf",
        "zip": "asdf",
        "region": null
    },
    "express": false
}'
```

or just load up `api.postman_collection.json` into Postman

no license
