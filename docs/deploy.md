
```
server {
    server_name www.edusoho.com.cn edusoho.com.cn;
    root /var/www/edusoho-online/web;

    location / {
        try_files $uri /app.php$is_args$args;
    }

    location ~ ^/app\.php(/|$) {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        internal;
    }

    location ~ \.php$ {
      return 404;
    }

    error_log /var/log/nginx/edusoho-online.error.log;
    access_log /var/log/nginx/edusoho-online.access.log;
}
```

chmod 777 var/logs
chmod 777 var/tmp
chmod 777 var/cache
chmod 777 web/files