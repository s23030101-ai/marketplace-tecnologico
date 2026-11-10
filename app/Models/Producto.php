app/Models/Producto.php


protected $fillable = [
    'user_id',
    'category_id',
    'name',
    'description',
    'price',
    'stock',
    'is_active',
];

app/Models/Producto.php:

public function usuario()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function categoria()
{
    return $this->belongsTo(Categoria::class, 'category_id');
}