Versioning
----------

Wydania będą numerowane wg. następującego formatu:

`<major>.<minor>.<patch>`

* Zmiany uniemożliwiające wsteczną kompatybilność podbijają 'major' i resetują 'minor' i 'patch'
* Nowe funkcjonalności które nie wpływają na wsteczną kompatybilność podbijają 'minor' i resetują 'patch'
* Poprawki i drobne zmiany podbijają 'patch'

Wersję paczki należy ustawiać ręcznie za pomocą githuba.

Więcej informacji dotyczących oznaczania wersji dla composera pod adresem:
https://github.com/composer/composer/blob/master/doc/04-schema.md

Informacje o wersjonowaniu aplikacji:
http://semver.org



Instalacja
----------

Jeśli nie zostały wcześniej wygenerowane należy wg. poniższej instrukcji wygenerować klucze ssh bez których composer nie połączy się z githubem.
https://help.github.com/articles/generating-ssh-keys

Do pliku composer.json należy dopisać prywatne repozytorium:

```javascript
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/code4interactive/platform"
    }
]
```

oraz wymaganą paczkę:

```javascript
"require": {
		"code4/platform": "1.0.*"
	},
```

Należy pamiętać aby "minimum-stability" było ustawione na "dev"

Po zainstalowaniu przez composera paczki platformy należy dopisać do pliku app/config/app.php w sekcji "providers" linijkę:

```php
'Code4\Platform\PlatformServiceProvider'
```

oraz opublikować wszystkie assety:

```bash
php artisan asset:publish code4/platform
```