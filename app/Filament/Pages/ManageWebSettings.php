<?php

namespace App\Filament\Pages;

use App\Models\WebInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageWebSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Settings';
    
    protected static ?string $navigationLabel = 'Website Information';
    
    protected static ?int $navigationSort = 100;

    protected static string $view = 'filament.pages.manage-web-settings';
    
    public ?array $data = [];
    
    public function mount(): void
    {
        $settings = WebInformation::first();
        
        if (!$settings) {
            $settings = WebInformation::create([
                'site_name' => 'My E-commerce Site',
            ]);
            
            Notification::make()
                ->title('Website information initialized')
                ->success()
                ->send();
        }
        
        $this->form->fill($settings->toArray());
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General Information')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(12),
                                Forms\Components\FileUpload::make('site_logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('website')
                                    ->columnSpan(6),
                                Forms\Components\FileUpload::make('site_favicon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('website')
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(255)
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('phone')
                                    ->maxLength(255)
                                    ->columnSpan(6),
                                Forms\Components\Textarea::make('address')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),

                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\RichEditor::make('about_us')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                Forms\Components\RichEditor::make('privacy_policy')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                Forms\Components\RichEditor::make('terms_conditions')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),

                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->schema([
                                Forms\Components\TextInput::make('facebook_link')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('twitter_link')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('instagram_link')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('youtube_link')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpan(6),
                                Forms\Components\TextInput::make('whatsapp_number')
                                    ->maxLength(255)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),

                        Forms\Components\Tabs\Tab::make('SEO Settings')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->maxLength(255)
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('meta_description')
                                    ->maxLength(255)
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('meta_keywords')
                                    ->maxLength(255)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(12)
            ->statePath('data');
    }
    
    public function save()
    {
        $settings = WebInformation::first();
        $data = $this->form->getState();
        
        $settings->update($data);
        
        Notification::make()
            ->title('Website information updated')
            ->success()
            ->send();
    }
} 