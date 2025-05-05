# Laravel DevCopilot

**DevCopilot** is a Laravel package that integrates ChatGPT directly into your Artisan CLI, giving you an intelligent assistant for explaining code, generating ideas, and streamlining development tasks—all without leaving your terminal.

---

## 🚀 Features

- 🤖 Ask ChatGPT questions directly from your Laravel project
- 🗂️ Include file contents as context using `--file`
- 🧠 Laravel-specific assistant for routes, controllers, migrations, and more

---

## 📦 Installation

1. Require the package via Composer (after it's published to Packagist):

```bash
composer require martink/laravel-devcopilot
```
2. Publish the config file:
```bash
php artisan vendor:publish --tag=config
```
3. Set your OpenAI API key in .env:
```
OPENAI_API_KEY=your-api-key-here
```

## 💡 Usage
Ask ChatGPT anything:
```
php artisan gpt:ask "Explain what the middleware 'auth' does in Laravel"
```
Include a file for deeper context:
```
php artisan gpt:ask "Explain this file" --file=routes/web.php
```

## ⚙️ Configuration
Published config file: config/devcopilot.php
```
return [
    'api_key' => env('OPENAI_API_KEY'),
];
```

---

## 🧪 Coming Soon
Multiple file support

* Context profiles (review, generate, explain)

* Answer caching

* Chat history log

### 🧑‍💻 Author
Made with ❤️ by Martin Karadzinov

