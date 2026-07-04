// EXAMPLE ROUTES para Panel de Administración
// Agrega esto a tu routes/web.php o routes/api.php

// use App\Http\Controllers\AdminCompanySettingController;

// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     // Dashboard de configuraciones
//     Route::get('settings', [AdminCompanySettingController::class, 'dashboard'])
//         ->name('admin.settings.dashboard');
    
//     // General Settings
//     Route::get('settings/general', [AdminCompanySettingController::class, 'editGeneral'])
//         ->name('admin.settings.general.edit');
//     Route::put('settings/general', [AdminCompanySettingController::class, 'updateGeneral'])
//         ->name('admin.settings.general.update');
    
//     // Contact Settings
//     Route::get('settings/contact', [AdminCompanySettingController::class, 'editContact'])
//         ->name('admin.settings.contact.edit');
//     Route::put('settings/contact', [AdminCompanySettingController::class, 'updateContact'])
//         ->name('admin.settings.contact.update');
    
//     // Branding Settings
//     Route::get('settings/branding', [AdminCompanySettingController::class, 'editBranding'])
//         ->name('admin.settings.branding.edit');
//     Route::put('settings/branding', [AdminCompanySettingController::class, 'updateBranding'])
//         ->name('admin.settings.branding.update');
    
//     // Social Settings
//     Route::get('settings/social', [AdminCompanySettingController::class, 'editSocial'])
//         ->name('admin.settings.social.edit');
//     Route::put('settings/social', [AdminCompanySettingController::class, 'updateSocial'])
//         ->name('admin.settings.social.update');
// });
