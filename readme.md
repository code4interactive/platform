Versioning
----------

Wydania będą numerowane wg. następującego formatu:

`<major>.<minor>.<patch>.<commit>`

* Zmiany uniemożliwiające wsteczną kompatybilność podbijają 'major' i resetują 'minor' i 'patch'
* Nowe funkcjonalności które nie wpływają na wsteczną kompatybilność podbijają 'minor' i resetują 'patch'
* Poprawki i drobne zmiany podbijają 'patch'
* 'commit' jest automatycznie nadawany przez skrypt opisany poniżej i używany jest tylko wewnętrznie

'major', 'minor' i 'path' należy ustawiać ręcznie za pomocą git tag.
Należy je ustawiać tylko wtedy kiedy wydawana jest nowa wersja aplikacji. Bierzące commity które służą tylko wymianie plików między developerami nie mogą wpływać na tagi.
Komunikaty do tagów należy ustawiać tak aby objaśniały najważniejszą zmianę lub jeśli było ich więcej zwykły opis wersji (jak na przykładzie poniżej)

Aktualna wersja została ustawiona następująco:

```bash
git tag -a 2.0.0
```

Aby uzyskać aktualną wersję należy skorzystać z poniższego skryptu:

```bash
#!/bin/bash
revisioncount=`git log --oneline | wc -l | tr -d ' '`
projectversion=`git describe --tags --long`
cleanversion=${projectversion%%-*}

echo "$cleanversion.$revisioncount"
```

Aby wysłać tagi na serwer github (domyślnie nie są) należy użyć polecenia

```bash
git push --tags
```

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
		"code4/platform": "0.*"
	},
```

Należy pamiętać aby "minimum-stability" było ustawione na "dev"

Po zainstalowaniu przez composera paczki platformy należy dopisać do pliku app/config/app.php w sekcji "providers" linijkę:

```php
'Code4\Platform\PlatformServiceProvider'
```