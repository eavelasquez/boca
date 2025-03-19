# BOCA Docker Setup

This repository contains Docker configuration files to run BOCA (BOCA Online Contest Administrator) in a Docker container.

## Requirements

- Docker
- Docker Compose

## Getting Started

1. Clone this repository:
   ```
   git clone https://github.com/eavelasquez/boca.git
   cd boca
   ```

2. Build and start the container:
   ```
   docker-compose up -d
   ```

3. Access BOCA in your browser:
   ```
   http://localhost:8080/boca/src/
   ```

4. Login credentials:
   - Username: `system`
   - Password: empty or `boca` (as configured in src/private/conf.php)

5. After your first login, immediately change the passwords for both `system` and `admin` users.

## Important Notes

- This Docker setup is intended for local development and testing purposes.
- For production use, please review the security configurations and ensure proper setup.
- The database data is stored in a Docker volume named `boca_data` to persist data between container restarts.

## Configuration

- The PostgreSQL database user is set to `bocauser` with password `boca`
- You can modify the configuration by editing the `src/private/conf.php` file before building the Docker image
- To access the container: `docker-compose exec boca bash`

## Creating a Contest

Follow these steps after logging in:

1. Log in as "system", empty password (or "boca")
2. Change the password for "system" user
3. Create a new contest
4. Change contest settings as needed and click "Send", then "Activate"
5. Log in as "admin", empty password (or "boca")
6. Change the password for "admin" user
7. Configure languages, problems, and users as needed

For more detailed information, please refer to the documentation in the `doc/` directory.

## Troubleshooting

If you encounter the "Not Found" error:
1. Make sure you're using the correct URL: `http://localhost:8080/boca/src/`
2. Check if the container is running: `docker-compose ps`
3. View the container logs: `docker-compose logs boca`
4. If needed, rebuild the container: `docker-compose up -d --build`

## License

This software is distributed under the terms of the GNU General Public License v3.0. 
