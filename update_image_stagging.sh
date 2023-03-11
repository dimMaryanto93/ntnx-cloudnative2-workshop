ssh root@192.168.3.121 <<EOF
kubectl set image deployment/apr-hotel-deployment-stagging container-hotel-stagging=192.168.2.113:5000/laravel_image_stagging:latest;
sleep 5;
kubectl set image deployment/apr-hotel-deployment-stagging container-hotel-stagging=192.168.2.113:5000/laravel_image_stagging;
sleep 5
EOF