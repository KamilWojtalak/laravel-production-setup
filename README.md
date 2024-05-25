TODO make a note

```
    /**
     * Sample response
     * <code>
     * [
     *      "name.pl" => "required_without_all:name.en,name.de,name.cz"
     *      "name.en" => "required_without_all:name.pl,name.de,name.cz"
     *      "name.de" => "required_without_all:name.pl,name.en,name.cz"
     *      "name.cz" => "required_without_all:name.pl,name.en,name.de"
     * ]
     * </code>
     */
    private function getNamesRules(Collection $allLocales): Collection
    {

        $names = $allLocales
            ->mapWithKeys(function ($locale) use ($allLocales) {
                ...
            });

        return $names;
    }
```


TODO make a note

```
stripe listen --forward-to localhost/stripe/fallback
```
