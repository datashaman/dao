default:

generate:
	php artisan migrate:generate --squash --ignore cache,cache_locks,failed_jobs,job_batches,jobs,migrations,password_reset_tokens,sessions,users
