<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content Management';

    protected static bool $shouldUseFullWidthFormDialogs = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Article Details')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $state, Forms\Set $set) {
                                        $set('slug', \Illuminate\Support\Str::slug($state));
                                    })
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->rules([
                                        function () {
                                            return function (string $attribute, $value, \Closure $fail) {
                                                if (request()->routeIs('filament.admin.resources.products.create')) {
                                                    if (\App\Models\Product::where('slug', $value)->exists()) {
                                                        $fail("This slug is already in use by a product.");
                                                    }elseif(\App\Models\Article::where('slug', $value)->exists()){
                                                        $fail("This slug is already in use by an article.");
                                                    }
                                                }
                                            };
                                        },
                                    ])
                                    ->disabled(fn (string $context): bool => $context === 'edit')
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('excerpt')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                TinyEditor::make('content')
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                Forms\Components\FileUpload::make('featured_image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('article-images')
                                    ->columnSpan(12),
                                Forms\Components\Toggle::make('is_published')
                                    ->required()
                                    ->default(false)
                                    ->columnSpan(12),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->nullable()
                                    ->columnSpan(12),
                            ])
                            ->columns(12),
                            
                        Forms\Components\Section::make('SEO Information')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('SEO Title')
                                    ->helperText('Leave empty to use the article title')
                                    ->maxLength(255)
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('SEO Description')
                                    ->helperText('Brief description for search engines')
                                    ->maxLength(255)
                                    ->columnSpan(12),
                                Forms\Components\TextInput::make('meta_keywords')
                                    ->label('SEO Keywords')
                                    ->helperText('Comma-separated keywords')
                                    ->maxLength(255)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),

                        Forms\Components\Section::make('Script')
                            ->schema([
                                Forms\Components\Textarea::make('header_script')
                                    ->label('Header Script')
                                    ->helperText('Script to be added to the header')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                                Forms\Components\Textarea::make('footer_script')
                                    ->label('Footer Script')
                                    ->helperText('Script to be added to the footer')
                                    ->maxLength(65535)
                                    ->columnSpan(12),
                            ])
                            ->columns(12),
                        
                    ])
                    ->columnSpan(12),
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                ->disk('public'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
