# Core `elmts`

# Konstrukcja i ładowanie plików `translations.php`

## Struktura plików tłumaczeń

Pliki `translations.php` są kluczowym elementem systemu tłumaczeń. Każdy plik powinien zawierać tablicę asocjacyjną, gdzie klucze odpowiadają kluczom tłumaczeń, a wartości to odpowiednie tłumaczenia. Klucz tłumaczenia tworzy hierarchiczną strukturę, która odzwierciedla organizację plików i tłumaczeń w projekcie.

### Przykładowa struktura klucza

```
__translations.errors.error404.description
```

Gdzie:
- `__translations` – oznacza nazwę pliku (bez rozszerzenia `.php`),
- Po kropce klucze tworzą hierarchicznie zagnieżdżone tablice asocjacyjne, które organizują tłumaczenia w logiczne grupy.

### Przykład zawartości pliku `translations.php`

```php
return [
    'errors' => [
        'error404' => [
            'description' => 'Strona nie została znaleziona.'
        ]
    ]
];
```

## Ładowanie tłumaczeń
Ładowanie tłumaczeń odbywa się poprzez metodę load(string $language): array w klasie odpowiedzialnej za tłumaczenia. Metoda korzysta z konfiguracji ścieżek i strategii ładowania plików, aby odczytać wszystkie pliki tłumaczeń dla danego języka.

## Proces ładowania
1. Sprawdzenie istnienia katalogu: Najpierw sprawdza, czy katalog dla danego języka istnieje. Jeśli nie, zgłasza wyjątek ElmtsException.
2. Odczyt plików: Dla każdej strategii ładowania (określonej przez rozszerzenia plików), metoda wyszukuje pliki pasujące do rozszerzenia.
3. Zbudowanie tablicy tłumaczeń: Każdy plik jest przetwarzany, a jego zawartość jest dodawana do głównej tablicy tłumaczeń. Struktura kluczy jest wykorzystywana do organizacji tłumaczeń w hierarchiczną strukturę.

## Przykład działania

```
$translations = $translationLoader->load('pl');
```

W powyższym przykładzie, metoda load zwróci skonsolidowaną tablicę tłumaczeń dla języka polskiego (pl), zorganizowaną po kluczach plików i odpowiednich segmentach tłumaczeń.


## Credits
