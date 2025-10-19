# Test Task Devigma

Simple Laravel project with Vue.js, configured to work with Docker using Laravel Sail.

## Quick Start

### 1. Run the project

Just execute one command:

```bash
make setup
```

This command will automatically:
- Install all dependencies
- Start Docker containers
- Setup database
- Create test user
- Build frontend

### 2. Access the application

**Application URL**: http://test-task-devigma.test

**Test login credentials**:
- Email: `test@example.com`
- Password: `password`

### 3. Database connection

Use `devigma` database for regular application and `devigma_test` for testing.

**Connection settings**:
- Host: `localhost` (or `127.0.0.1`)
- Port: `3307`
- Database: `devigma`
- Username: `sail`
- Password: `password`

### 4. Stop and remove containers

To completely stop and remove all containers and volumes:

```bash
./vendor/bin/sail down -v
```
