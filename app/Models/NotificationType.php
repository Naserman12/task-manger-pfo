<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotificationType extends Model
{
       protected $fillable = [
        'name',        // اسم النظامي (مثلاً: task_assigned)
        'label_ar',    // الاسم الظاهر بالعربية (مثلاً: تم توكيلك بمهمة)
        'icon'         // الأيقونة المناسبة
    ];

    /**
     * الإشعارات المرتبطة بهذا النوع.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'notification_type_id');
    }
}
