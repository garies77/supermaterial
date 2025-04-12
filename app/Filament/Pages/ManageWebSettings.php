<?php

namespace App\Filament\Pages;

use App\Models\WebInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\Textarea;

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
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(255)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),

                        Forms\Components\Tabs\Tab::make('Footer Information')
                            ->schema([
                                //     ->columnSpan(6),
                                TinyEditor::make('column_1')
                                    ->label('Column 1 Content')
                                    ->helperText('Content for the first footer column')
                                    ->maxLength(65535)
                                    ->columnSpan(6),
                                TinyEditor::make('column_2')
                                    ->label('Column 2 Content')
                                    ->helperText('Content for the second footer column')
                                    ->maxLength(65535)
                                    ->columnSpan(6),
                                TinyEditor::make('column_3')
                                    ->label('Column 3 Content')
                                    ->helperText('Content for the third footer column')
                                    ->maxLength(65535)
                                    ->columnSpan(6),
                                TinyEditor::make('column_4')
                                    ->label('Column 4 Content')
                                    ->helperText('Content for the fourth footer column')
                                    ->maxLength(65535)
                                    ->columnSpan(6),
                            ])
                            ->columns(12),

                        Forms\Components\Tabs\Tab::make('Page Content')
                            ->schema([
                                TinyEditor::make('home')
                                    ->label('Home Page Content')
                                    ->helperText('Content specific to the home page')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                TinyEditor::make('product')
                                    ->label('Product Page Content')
                                    ->helperText('Content specific to product pages')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                TinyEditor::make('article')
                                    ->label('Article Page Content')
                                    ->helperText('Content specific to article pages')
                                    ->maxLength(65535)
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
                                Forms\Components\FileUpload::make('meta_image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('website/seo')
                                    ->columnSpan(12),
                            ])
                            ->columns(12),
                            
                        Forms\Components\Tabs\Tab::make('Scripts')
                            ->schema([
                                Forms\Components\Textarea::make('header_script')
                                    ->label('Header Scripts')
                                    ->helperText('Scripts to be included in the <head> section (Analytics, Meta pixels, etc.)')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('footer_script')
                                    ->label('Footer Scripts')
                                    ->helperText('Scripts to be included before the closing </body> tag')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),
                        Forms\Components\Tabs\Tab::make('Page Components')
                            ->schema([
                                Forms\Components\Card::make()
                                    ->schema([
                                        Textarea::make('home_header_component')
                                            ->label('Home Header Component')
                                            ->helperText('Component for the home page header')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                        Textarea::make('home_footer_component')
                                            ->label('Home Footer Component')
                                            ->helperText('Component for the home page footer')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                    ])
                                    ->heading('Home Page Components')
                                    ->columnSpan(12),
                                Forms\Components\Card::make()
                                    ->schema([
                                        Textarea::make('product_header_component')
                                            ->label('Product Header Component')
                                            ->helperText('Component for the product page header')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                        Textarea::make('product_footer_component')
                                            ->label('Product Footer Component')
                                            ->helperText('Component for the product page footer')
                                            ->maxLength(65535)
                                            ->columnSpan(12),

                                        Textarea::make('product_detail_header_component')
                                            ->label('Product Detail Header Component')
                                            ->helperText('Component for the product detail page header')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                        Textarea::make('product_detail_footer_component')
                                            ->label('Product Detail Footer Component')
                                            ->helperText('Component for the product detail page footer')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                            
                                            
                                    ])
                                    ->heading('Product Page Components')
                                    ->columnSpan(12),
                                Forms\Components\Card::make()
                                    ->schema([
                                        Textarea::make('article_header_component')
                                            ->label('Article Header Component')
                                            ->helperText('Component for the article page header')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                        Textarea::make('article_footer_component')
                                            ->label('Article Footer Component')
                                            ->helperText('Component for the article page footer')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                        Textarea::make('article_detail_header_component')
                                            ->label('Article Detail Header Component')
                                            ->helperText('Component for the article detail page header')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                        Textarea::make('article_detail_footer_component')
                                            ->label('Article Detail Footer Component')
                                            ->helperText('Component for the article detail page footer')
                                            ->maxLength(65535)
                                            ->columnSpan(12),
                                    ])
                                    ->heading('Article Page Components')
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