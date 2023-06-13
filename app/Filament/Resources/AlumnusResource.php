<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumnusResource\Pages;
use App\Filament\Resources\AlumnusResource\RelationManagers;
use App\Models\Alumnus;
use App\Models\Jurusan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlumnusResource extends Resource
{
    protected static ?string $model = Alumnus::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                            ->label('Nama')
                            ->required(),
                TextInput::make('nim')
                            ->label('Nim')
                            ->required(),    
                Select::make('gender')
                            ->label('Gender')
                            ->required()
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan'
                            ]),
                Select::make('jurusan_id')
                            ->label('Jurusan')
                            ->required()
                            ->options(Jurusan::all()->pluck('nama_jurusan', 'id')->toArray()),
                Select::make('prodi_id')
                            ->label('Program Studi')
                            ->required()
                            ->options(Jurusan::all()->pluck('nama_prodi', 'id')->toArray()),
                TextInput::make('ipk')
                            ->label('IPK')
                            ->required(),
                TextInput::make('email')
                            ->label('Email')
                            ->required(),
                TextInput::make('class')
                            ->label('Class')
                            ->required(),
                TextInput::make('company')
                            ->label('Perusahaan')
                            ->required(),   
                Fileupload::make('photo')   
                            ->required()                               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                                ->label('Photo'),
                TextColumn::make('nama')
                            ->label('Nama'),
                TextColumn::make('nim')
                            ->label('Nim'),
                TextColumn::make('jurusan.nama_jurusan')
                            ->label('Jurusan'),  
                TextColumn::make('prodi.nama_prodi')
                            ->label('Prodi'), 
                TextColumn::make('email')
                            ->label('Email'), 
                TextColumn::make('class')
                            ->label('Class'),  
                TextColumn::make('company')
                            ->label('Perusahaan'),                                          
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAlumni::route('/'),
            'create' => Pages\CreateAlumnus::route('/create'),
            'edit' => Pages\EditAlumnus::route('/{record}/edit'),
        ];
    }    
}
