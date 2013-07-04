Versioning
----------

Wydania będą numerowane wg. następującego formatu:

`<major>.<minor>.<patch>`

* Zmiany uniemożliwiające wsteczną kompatybilność podbijają 'major' i resetują 'minor' i 'patch'
* Nowe funkcjonalności które nie wpływają na wsteczną kompatybilność podbijają 'minor' i resetują 'patch'
* Poprawki i drobne zmiany podbijają 'patch'

'major', 'minor' i 'path' należy ustawiać ręcznie za pomocą githuba.
Należy je ustawiać tylko wtedy kiedy wydawana jest nowa wersja aplikacji. Bierzące commity które służą tylko wymianie plików między developerami nie mogą wpływać na tagi.
Komunikaty do tagów należy ustawiać tak aby objaśniały najważniejszą zmianę lub jeśli było ich więcej zwykły opis wersji

Więcej informacji dotyczących oznaczania wersji dla composera pod adresem:
https://github.com/composer/composer/blob/master/doc/04-schema.md

Aby usunąć tag (tylko w przypadku popełnienia błędu!!!) należy usunąć go lokalnie:

```bash
git tag -d mojTag
```

A następnie pushować zmianę na serwer:

```bash
git push origin :refs/tags/mojTag
```


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