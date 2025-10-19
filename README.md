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

## Time spent
More than 3 hours

## Notes

1. **Route → Single Action Controller → Form Request → DTO → Service → Model → Resource architecture** (SRP) - This is over-engineering for a simple project with some code duplication in its implementation, but this architecture could be beneficial if the project will be scaled up

2. **Hardcoded time slots in both frontend and backend validation** - Add time slots as a database table for future modification from admin panel, and refactor backend and frontend by removing hardcoded time slots

## Improvements

1. **Add API documentation** - Implement Swagger/OpenAPI documentation for all endpoints

2. **Add pagination** - Implement pagination for booking lists to handle large datasets

3. **Add search and filtering** - Allow users to search and filter their bookings

4. **Enhanced booking status management** - Instead of just changing status to "cancelled", come up with some more interesting logic - add a delete button that performs soft delete, add `cancelled_at` and `deleted_at` timestamps
