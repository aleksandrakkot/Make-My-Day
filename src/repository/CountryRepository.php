<?php

require_once 'Repository.php';

class CountryRepository extends Repository
{
    public function getCountries()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.country ORDER BY country_name ASC;
        ');
        $stmt->execute();
        return $stmt;
    }

    public function getCountryId(string $name)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT country_id FROM public.country WHERE country_name = :country ;
        ');
        $stmt->bindParam(':country', $name, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['country_id'];
    }
}
