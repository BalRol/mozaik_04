namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $table = 'user';

    public $timestamps = false;

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
