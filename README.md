# Rewards

This is a to be a simple app that keeps track of things I should be doing (mostly foods and exercise) and allows for rewards (mostly beer or other treats).

## Setup

Basic HTTP authentication is used here. Define the following two variables in the host environment with your desired username and password.

- HTTP_USER
- HTTP_PASSWORD

In production, MYSQL is used, primarily because the old rewards app used it, so we'll use it too! The following parameters need to be present for that.

- DB_NAME
- DB_USERNAME
- DB_PASSWORD
- DB_HOST 
- DB_PORT

