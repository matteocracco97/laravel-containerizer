# Laravel Containerizer 🚀

> From a Laravel repository to Docker & Kubernetes in minutes.

Laravel Containerizer is an **open-source, Laravel-first tool** that analyzes your Laravel project and automatically generates:

- Dockerfile
- docker-compose.yml
- Kubernetes manifests (PA-ready)

All through a **modern UI wizard**.

---

## ❓ Why this exists

If you are a Laravel developer, you already know the pain:

- Writing Dockerfiles every time
- Fighting with docker-compose
- Converting everything to Kubernetes YAML
- Public Administrations that **ban docker-compose** and only want manifests

This tool was born from pure frustration.

---

## ✨ What it does

✅ Connects to your GitHub account  
✅ Analyzes your Laravel repository  
✅ Detects:
- Database driver
- Redis
- Queues
- Scheduler
- Horizon
- WebSockets
- Storage drivers  

✅ Generates:
- Optimized Dockerfile (multi-stage, non-root, cache-friendly)
- Clean docker-compose.yml
- Kubernetes manifests (Deployment, Service, ConfigMap, Secret, Job)

---

## 🧩 Who is this for?

- Laravel developers
- DevOps beginners
- Public Administration projects
- Teams that want **standardized deployments**

---

## 🖥️ UI Preview

> 🚧 Demo GIF coming soon

*(Wizard → Options → Generated files)*

---

## ⚙️ Features

- Laravel 12 compatible
- PHP 8.3+
- GitHub OAuth
- Smart dependency detection
- UX-first wizard
- Kubernetes-first mindset
- PA-ready manifests

---

## 🗺️ Roadmap

### v1 (MVP)
- [ ] GitHub OAuth
- [ ] Laravel project analyzer
- [ ] Dockerfile generator
- [ ] docker-compose generator
- [ ] Kubernetes base manifests

### v2
- [ ] Advanced Kubernetes options
- [ ] Helm chart export
- [ ] Playground (preview only)

### v3
- [ ] Full playground (sandbox execution)
- [ ] CI/CD generator
- [ ] PA compliance templates

---

## 🛠️ Tech Stack

- Laravel 12
- PHP 8.3+
- Tailwind CSS
- GitHub API
- Symfony YAML
- Monaco Editor (future)

---

## 📦 Installation (local dev)

```bash
git clone https://github.com/<your-username>/laravel-containerizer.git
cd laravel-containerizer
composer install
npm install && npm run dev
php artisan serve
