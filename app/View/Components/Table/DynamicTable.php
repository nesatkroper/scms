<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DynamicTable extends Component
{
    public $headers,
        $items,
        $emptyMessage,
        $actions,
        $checkbox,
        $actionItems;
    public function __construct(
        array $headers,
        $items = [],
        string $emptyMessage = 'No records found',
        bool $checkbox = true,
        $actions = true
    ) {
        $this->headers = $headers;
        $this->items = $items;
        $this->emptyMessage = $emptyMessage;
        $this->checkbox = $checkbox;
        $this->actions = $actions;
        // Handle actions parameter
        if (is_bool($actions)) {
            $this->actions = $actions;
            $this->actionItems = $actions ? ['edit', 'detail', 'delete'] : [];
        } else {
            $this->actions = !empty($actions);
            $this->actionItems = is_array($actions) ? $actions : [];
        }
    }
    public function render(): View|Closure|string
    {
        return view('components.table.dynamic-table');
    }

    public static function getDisplayValue($item, $key)
    {
        // If the key exists as a method or property, use that first
        if (method_exists($item, $key) || isset($item->{$key})) {
            return $item->{$key} ?? 'N/A';
        }
        // Special cases
        if (in_array($key, ['role', 'type']) && method_exists($item, 'getRoleNames')) {
            return $item->getRoleNames()->first() ?? 'N/A';
        }

        return 'N/A';
    }
}
