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

    public function getCities()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.city ORDER BY city_name ASC;
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

    public function getCityId(string $name)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT city_id FROM public.city c
            WHERE c.city_name = :cityy
        ');
        $stmt->bindParam(':cityy', $name, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['city_id'];
    }

    public function getCityName($id){
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.city WHERE city_id = :cityId;
        ');
        $stmt->bindParam(':cityId', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['city_name'];
    }
}
