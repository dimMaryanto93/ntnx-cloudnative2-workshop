ssh root@192.168.3.121 <<EOF
kubectl set image deployment/apr-hotel-deployment container-hotel=192.168.2.113:5000/laravel_image_master:latest;
sleep 5;
kubectl set image deployment/apr-hotel-deployment container-hotel=192.168.2.113:5000/laravel_image_master;
sleep 5
EOF