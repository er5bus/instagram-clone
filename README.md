Instagram clone Project
========================

- Registration with username, email and password
- Connection
- News feed
- Post creation
- Search functionality in posts
- Ergonomic visual interface similar to that of Instagram

Requirements
------------

  * PHP 7.1 or higher;
  * PDO-SQLite PHP extension enabled;
  * Symfony binary;
  * and the [usual Symfony application requirements][2].

Installation
------------

### Step 1 : Clone the project

Now clone the project from github.

```bash
$ git clone https://github.com/er5bus/instagram-clone.git
```

### Step 2 : Install dependencies

Now that the project is cloned, running the following command should install all the symfony dependencies:

```bash
$ composer install
```

### Step 3 : Configuration

Now configure the .env file under project root.

### Step 4 : Run the project

Now run this command to run the built-in web server and access the application in your browser at <http://localhost:8000>:

```bash
$ symfony server:start
```

That's it.
