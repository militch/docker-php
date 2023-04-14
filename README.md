## 使用方法

1. 编译镜像

```bash
docker build -t wordpress \
--build-arg CNBUILD= .
```

设置 `CNBUILD` 选项将使用国内源

2. 启动服务(示例)

```bash
docker run --name wordpress --rm \
-it -p "0.0.0.0:8011:80" wordpress
```


