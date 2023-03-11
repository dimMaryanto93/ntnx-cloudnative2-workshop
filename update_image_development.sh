ssh root@192.168.3.121 <<EOF
kubectl set image deployment/apr-hotel-deployment-development container-hotel-development=192.168.2.113:5000/laravel_image_development:latest;
sleep 5;
kubectl set image deployment/apr-hotel-deployment-development container-hotel-development=192.168.2.113:5000/laravel_image_development;
sleep 5
EOF