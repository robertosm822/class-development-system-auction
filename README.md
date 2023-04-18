# Class Development System Auction

 - Training on Youtube to develop an online auction system. Full Stack Mode (Severine's).

## Install development environment with `Docker Desktop`

In your GitBash terminal or VS Code terminal (with the Docker service active in this folder) enter the following command:

  `docker compose up`
  
This will upload the image version of one container with Laravel version 9 and another container with MariaDB (MySQL) database version 10.

![image](https://user-images.githubusercontent.com/3953157/232828228-0066e9f2-6901-4207-9ff2-8d5c94d0a1aa.png)

Executing the `docker ps` command, we will list the active containers to retrieve the IDs that we will use to enter the command line inside the machines of each service:

![image](https://user-images.githubusercontent.com/3953157/232829113-288f5fd3-96b4-4339-8715-c06cf405af9d.png)

Now, finally, we are able to enter, for example, the Docker image that is running the entire Laravel 9 service at the local URL `http://localhost:8000`:

  `docker exec -it [ID_CONTAINER] /bin/bash` or `docker exec -it app-inicial-myapp-1 /bin/bash`
 
Result:
![image](https://user-images.githubusercontent.com/3953157/232830380-b4634d0c-9ae1-41e1-9ebf-ea9fc878c986.png)

