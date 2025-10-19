# Test Task Devigma

### Technologies Used

- **Laravel 12** - PHP framework
- **Vue 3** - Frontend framework  
- **Tailwind CSS 4** - CSS framework
- **Axios** - HTTP client
- **Laravel Breeze** - Authentication scaffolding
- **Laravel Sail** - Docker development environment
- **Makefile** - Build automation

## Quick Start

### 1. Add to hosts file

```
127.0.0.1 test-task-devigma.test
```

### 2. Run the project

```bash
make setup
```

This command will automatically:
- Install all dependencies
- Start Docker containers
- Setup database
- Create test user
- Build frontend

### 3. Access the application

**Application URL**: http://test-task-devigma.test

**Test login credentials**:
- Email: `test@example.com`
- Password: `password`

### 4. Database connection

Use `devigma` database for regular application and `devigma_test` for testing.

**Connection settings**:
- Host: `localhost` (or `127.0.0.1`)
- Port: `3307`
- Database: `devigma`
- Username: `sail`
- Password: `password`

### 5. Stop and remove containers

To completely stop and remove all containers and volumes:

```bash
./vendor/bin/sail down -v
```
