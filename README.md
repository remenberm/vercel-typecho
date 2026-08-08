# 1.介绍
这是一个采用vercel进行部署typecho的Serverless项目。
# 2.如何使用？
将这个仓库star，并fork。在vercel里新建项目，选择这个项目，等待部署。并在vercel storage下新建一个Postgres Database。然后不出所料就会得到以下数据![一个包含数据库信息的东西](https://i.ibb.co/tBvLH0h/Screenshot-20240814-114014-com-microsoft-emmx.jpg)
打开Show secret，default冒号后@前即为数据库密码
而@后面:5432前面为数据库地址。
打开vercel绑定的域名，在后面添加/install.php，填写数据库信息，类型为pgsql数据库用户名即为default，数据库名为verceldb
然后会生成config.inc.php文件内容，复制下来，放到新建的config.inc.php里，上传到你fork的仓库根目录，等部署完成后点继续，会填写一下信息，填写完后就可以享受你的typecho啦
# 3.常见问题
## 1.域名无法访问
请绑定自己的域名，vercel自带域名被墙了
## 2.数据库无法连接
请检查信息填写是否正确
## 3.怎么安装主题和插件
把插件或主题文件复制到usr/plugins或usr/themes目录下

> 简介：该项目能够实现在Vercel平台上一键部署Typecho，自动化程度较高，部署非常丝滑~

## 💡项目简介
Typecho on Vercel 是一个让你能够在 Vercel 平台上零成本部署 Typecho 博客系统的项目。基于 Typecho 官方开源代码修改适配，完美兼容 Vercel 的无服务器环境。

## 💡项目特色
- 💰 0 成本：完全依托于 Vercel 的免费资源
- 🚀 一键部署：操作便捷，快速上线-
- ⚡ 保留官方能力：保留 Typecho 官方基础功能，并适配 Vercel 部署环境-
- 🔄 自动同步：通过 GitHub Actions 定时拉取更新

## ⌛部署步骤

### 1.拉取源码

**方法一：Vercel一键部署（推荐）**

<a href="https://vercel.com/new/clone?repository-url=https://github.com/remenberm/vercel-typecho" target="_blank" rel="noreferrer"><img src="https://vercel.com/button" alt="部署到 Vercel"></a>

**方法二：直接fork本项目**
> [!IMPORTANT]
> 在 Vercel 中导入该仓库
> 拉取源码后请及时将仓库设为私有，以防敏感信息泄露


### 2.创建数据库
在创建好的vercel项目中，选择`Storage - Create Database - Neon`，然后一直下一步，全部默认
💡 Neon 是 Vercel 官方推荐的 PostgreSQL 数据库服务，提供免费额度，非常适合本项目。

### 3.再次部署Vercel
进入 Vercel 项目面板的 Deployments → Create Deployment，重新部署一次以使数据库配置生效
进入`Deployments - Create Deployment`

### 4.开始安装
访问 你的域名/install.php，按照安装向导一路下一步即可-1。最后为网站设置后台用户名和密码，安装完成！🎉

## 🖼图片上传
本项目使用https://github.com/lhl77/Typecho-Plugin-PicUp

使用教程请参考此项目简介<a href="https://blog.lhl.one/artical/1026.html">PicUp中文文档</a> ·

## 注意
Vercel 的生产环境是基于无服务器 (Serverless) 架构的，其文件系统本质上是只读的（Read-Only File System）。使用过程中可能出现文件权限问题，请自行探索。
