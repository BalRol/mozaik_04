namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'date',
        'location',
        'image',
        'type',
        'description',
        'visibility',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'name');
    }
}
