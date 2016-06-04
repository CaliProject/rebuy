<?php

namespace Rebuy\Library\Traits;

use Carbon\Carbon;

trait TimeSortable {

    /**
     * The column to be sorted.
     *
     * @var string
     */
    protected $sortColumn = self::CREATED_AT;

    /**
     * Scope the query to only today.
     *
     * @param      $query
     * @param null $column
     * @return mixed
     *
     * @author Cali
     */
    public function scopeToday($query, $column = null)
    {
        // $query->where('created_at, '>=', 今天);
        return $query->where($this->getTimeColumn($column), '>=', Carbon::today());
    }

    /**
     * Scope the query to only yesterday.
     *
     * @param      $query
     * @param null $column
     * @return mixed
     *
     * @author Cali
     */
    public function scopeYesterday($query, $column = null)
    {
        return $query->where([
            [$this->getTimeColumn($column), '>=', Carbon::yesterday()],
            [$this->getTimeColumn($column), '<', Carbon::today()]
        ]);
    }

    /**
     * Scope the query to last week.
     *
     * @param      $query
     * @param null $column
     * @return mixed
     *
     * @author Cali
     */
    public function scopeLastWeek($query, $column = null)
    {
        // 过去7天
        return $query->where([
            [$this->getTimeColumn($column), '>=', Carbon::today()->subWeek()],
            [$this->getTimeColumn($column), '<', Carbon::now()]
        ]);
    }

    /**
     * Scope the query to last full week.
     *
     * @param      $query
     * @param null $column
     * @return mixed
     *
     * @author Cali
     */
    public function scopeLastFullWeek($query, $column = null)
    {
        // 上一周
        return $query->where([
            [$this->getTimeColumn($column), '>=', Carbon::today()->startOfWeek()->subWeek()],
            [$this->getTimeColumn($column), '<', Carbon::today()->startOfWeek()]
        ]);
    }

    /**
     * Scope the query to this month.
     *
     * @param      $query
     * @param null $column
     * @return mixed
     *
     * @author Cali
     */
    public function scopeThisMonth($query, $column = null)
    {
        return $query->where([
            [$this->getTimeColumn($column), '>=', Carbon::today()->startOfMonth()],
            [$this->getTimeColumn($column), '<=', Carbon::now()]
        ]);
    }

    /**
     * Scope the query to last month.
     *
     * @param      $query
     * @param null $column
     * @return mixed
     *
     * @author Cali
     */
    public function scopeLastMonth($query, $column = null)
    {
        return $query->where([
            [$this->getTimeColumn($column), '>=', Carbon::today()->subMonth()],
            [$this->getTimeColumn($column), '<', Carbon::now()]
        ]);
    }

    /**
     * Scope the query to last full month.
     *
     * @param      $query
     * @param null $column
     * @return mixed
     *
     * @author Cali
     */
    public function scopeLastFullMonth($query, $column = null)
    {
        return $query->where([
            [$this->getTimeColumn($column), '>=', Carbon::today()->startOfMonth()->subMonth()],
            [$this->getTimeColumn($column), '<', Carbon::today()->startOfMonth()]
        ]);
    }

    /**
     * Get the time column.
     *
     * @param null $column
     * @return string
     * @author Cali
     */
    protected function getTimeColumn($column = null)
    {
        // 默认用created_at进行排序或过滤
        $this->sortColumn = $column ?: self::CREATED_AT;

        return $this->sortColumn ?: 'created_at';
    }
}