## 使用方法

### 快速启动

```bash
docker compose up -d
```

### 自定义编译

1. 编译镜像

```bash
docker build -t wordpress \
--build-arg CNBUILD= .
```

设置 `CNBUILD` 选项使用国内源（加快国内下载速度）

2. 启动服务(示例)

```bash
docker run --name wordpress --rm \
-it -p "0.0.0.0:8011:80" wordpress
```


