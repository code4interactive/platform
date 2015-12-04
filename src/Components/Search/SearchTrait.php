<?php

namespace Code4\Platform\Components\Search;

trait SearchTrait {

    protected $hasSoftDeleteTrait = false;

    /**
     * Wykonuje wyszukiwanie w tablicy modelu danych szukając $str w kolumnach zdefiniowanych w $searchableColumns
     * @param string $str
     * @param bool $includeDeleted
     * @return EloquentCollection,Collection
     * @throws \Exception
     */
    public function searchInColumns($str, $includeDeleted = false)
    {
        //Sprawdzamy czy klasa używa softdelete aby uwzględnić to przy wyszukiwaniu
        $this->hasSoftDeleteTrait = method_exists($this, 'getDeletedAtColumn');

        if ( ! is_array($this->searchableColumns) || count($this->searchableColumns) == 0)
        {
            throw new \Exception('No searchable columns defined in $searchableColumns[]');
        }

        $searchableColumns = $this->searchableColumns;

        $query = self::where(function ($query) use ($str, $searchableColumns)
        {
            $first = true;
            foreach ($this->searchableColumns as $column)
            {
                if ($first)
                {
                    if ($column == 'created_at') {
                        $query->raw(' OR WHERE '.$column.'::string like '.'%' . $str . '%');
                        //$query->orwhere($column.'::string', 'like', '%' . $str . '%');
                    } else
                    {
                        $query->where($column, 'like', '%' . $str . '%');
                    }
                    $first = false;
                } else
                {
                    if ($column == 'created_at') {
                        $query->raw(' OR WHERE '.$column.'::string like '.'%' . $str . '%');

                        //$query->orwhere($column.'::string', 'like', '%' . $str . '%');
                    } else
                    {
                        $query->orwhere($column, 'like', '%' . $str . '%');
                    }
                }
            }
        });

        if ($this->hasSoftDeleteTrait && ! $includeDeleted)
        {
            $query->whereNull('deleted_at');
        }

        return $query;
    }

    public function getDataForDataTable($start, $length, $search, $orderCol, $orderDir) {

        $query = $this->searchInColumns($search);
        return $query->skip($start)
            ->take($length)
            ->orderBy($orderCol, $orderDir)
            ->get();

        /*return static::where(function($query) use ($search, $searchableColumns) {
            $query->where('email', 'like', '%'.$search.'%');
            $query->orWhere('first_name', 'like', '%'.$search.'%');
            $query->orWhere('last_name', 'like', '%'.$search.'%');
            $query->orWhere('job_title', 'like', '%'.$search.'%');
        })->whereNull('deleted_at')
            ->skip($start)
            ->take($length)
            ->orderBy($orderCol, $orderDir)
            ->get();*/

    }



}