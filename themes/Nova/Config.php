<?php

declare(strict_types=1);

namespace Themes\Nova;

use Revoltify\Support\Forms\Components\Field;
use Revoltify\Support\Forms\Components\Grid;
use Revoltify\Support\Forms\Components\Section;
use Revoltify\Support\Forms\Components\Tab;
use Revoltify\Support\Forms\Components\Tabs;
use Revoltify\Support\Forms\Form;
use Revoltify\Themeify\AbstractTheme;
use Revoltify\Themeify\Enums\ThemeEngine;

final class Config extends AbstractTheme
{
    public function name(): string
    {
        return 'Nova';
    }

    public function description(): string
    {
        return 'A fresh, modern checkout experience built to make every payment feel effortless.';
    }

    public function version(): string
    {
        return '1.0.0';
    }

    public function author(): string
    {
        return 'UddoktaPay';
    }

    public function authorUrl(): string
    {
        return 'https://uddoktapay.com';
    }

    public function logo(): string
    {
        return 'assets/thumbnail.png';
    }

    public function engine(): ThemeEngine
    {
        return ThemeEngine::Inertia;
    }

    public function form(): Form
    {
        return Form::make([
            Tabs::make('theme_tabs')
                ->tabs([
                    Tab::make('colors')
                        ->label('Colors')
                        ->icon('heroicon-o-swatch')
                        ->schema([
                            Section::make('brand_colors')
                                ->label('Brand Colors')
                                ->description('Applied as CSS variables on the page root.')
                                ->schema([
                                    Grid::make('brand_colors_grid', 2)
                                        ->schema([
                                            Field::make('primary_color')
                                                ->color()
                                                ->label('Primary')
                                                ->helperText('Buttons, links and highlights. Default #275EFF'),

                                            Field::make('primary_light_color')
                                                ->color()
                                                ->label('Primary Light')
                                                ->helperText('The lighter stop of the button gradient. Default #92AEFF'),

                                            Field::make('background_color')
                                                ->color()
                                                ->label('Page Background')
                                                ->helperText('Default #EDF6FE'),

                                            Field::make('text_color')
                                                ->color()
                                                ->label('Text')
                                                ->helperText('Default #0F172A'),

                                            Field::make('text_muted_color')
                                                ->color()
                                                ->label('Muted Text')
                                                ->helperText('Labels and secondary copy. Default #64748B'),

                                            Field::make('border_color')
                                                ->color()
                                                ->label('Border')
                                                ->helperText('Default #E2E8F0'),
                                        ]),
                                ]),

                            Section::make('shape')
                                ->label('Shape')
                                ->description('Corner rounding, in pixels.')
                                ->collapsible()
                                ->schema([
                                    Grid::make('shape_grid', 2)
                                        ->schema([
                                            Field::make('radius_btn')
                                                ->number()
                                                ->label('Button Radius')
                                                ->helperText('Default 16'),

                                            Field::make('radius_card')
                                                ->number()
                                                ->label('Card Radius')
                                                ->helperText('Default 12'),
                                        ]),
                                ]),
                        ]),

                    Tab::make('links')
                        ->label('Links')
                        ->icon('heroicon-o-link')
                        ->schema([
                            Section::make('links')
                                ->label('Links')
                                ->description('YouTube and Vimeo links are converted to their embed form automatically.')
                                ->schema([
                                    Grid::make('links_grid', 2)
                                        ->schema([
                                            Field::make('faq_video_url')
                                                ->text()
                                                ->label('FAQ Video URL')
                                                ->helperText('Shown above the questions in the FAQ panel.'),

                                            Field::make('gateway_video_url')
                                                ->text()
                                                ->label('Default Gateway Video URL')
                                                ->helperText('Used by any gateway page without its own video below.'),
                                        ]),
                                ]),

                            Section::make('gateway_videos')
                                ->label('Gateway Help Videos')
                                ->description('Each one adds a How to pay button to that gateway page only. Leave a field empty to fall back to the default above, and leave both empty to hide the button.')
                                ->collapsible()
                                ->schema([
                                    Grid::make('gateway_videos_grid', 2)
                                        ->schema([
                                            Field::make('gateway_video_url_mfs')
                                                ->text()
                                                ->label('Mobile Banking Video URL'),

                                            Field::make('gateway_video_url_banglaqr')
                                                ->text()
                                                ->label('Bangla QR Video URL'),

                                            Field::make('gateway_video_url_banktransfer')
                                                ->text()
                                                ->label('Bank Transfer Video URL'),

                                            Field::make('gateway_video_url_bank')
                                                ->text()
                                                ->label('Manual Bank Video URL'),

                                            Field::make('gateway_video_url_binance')
                                                ->text()
                                                ->label('Binance Video URL'),

                                            Field::make('gateway_video_url_bybit')
                                                ->text()
                                                ->label('Bybit Video URL'),
                                        ]),
                                ]),
                        ]),

                    Tab::make('pages')
                        ->label('Pages')
                        ->icon('heroicon-o-rectangle-group')
                        ->schema([
                            Section::make('mfs_page')
                                ->label('MFS Page')
                                ->description('How the payment details are laid out on mobile wallet gateways.')
                                ->schema([
                                    Grid::make('mfs_page_grid', 2)
                                        ->schema([
                                            Field::make('mfs_instruction_style')
                                                ->select([
                                                    'details' => 'Details rows',
                                                    'steps' => 'Numbered steps',
                                                ], 'details')
                                                ->label('Payment Details Style')
                                                ->helperText('Details rows: the account number and amount as two labelled rows, with the instructions above them. Numbered steps: one step per action, with the number and amount to copy inside the step that needs them.')
                                                ->columnSpanFull(),
                                        ]),
                                ]),
                        ]),

                    Tab::make('custom_code')
                        ->label('Custom Code')
                        ->icon('heroicon-m-code-bracket')
                        ->badge('Advanced')
                        ->schema([
                            Section::make('global_css_section')
                                ->label('Global CSS')
                                ->description('CSS that applies across all pages. Do not wrap in <style> tags.')
                                ->collapsible()
                                ->schema([
                                    Field::make('global_css')
                                        ->codeEditor()
                                        ->label('Global CSS')
                                        ->language('css')
                                        ->helperText('Only enter raw CSS rules.'),
                                ]),

                            Section::make('global_js_section')
                                ->label('Global JS')
                                ->description('JavaScript that applies across all pages. Do not wrap in <script> tags.')
                                ->collapsible()
                                ->schema([
                                    Field::make('global_js')
                                        ->codeEditor()
                                        ->label('Global JavaScript')
                                        ->language('javascript')
                                        ->helperText('Only enter raw JavaScript code.'),
                                ]),

                            Section::make('checkout_page_code')
                                ->label('Checkout Page Code')
                                ->description('Customize only the checkout page.')
                                ->collapsible()
                                ->collapsed()
                                ->schema([
                                    Field::make('checkout_css')
                                        ->codeEditor()
                                        ->label('Checkout CSS')
                                        ->language('css'),

                                    Field::make('checkout_js')
                                        ->codeEditor()
                                        ->label('Checkout JavaScript')
                                        ->language('javascript'),
                                ]),

                            Section::make('gateway_page_code')
                                ->label('Gateway Page Code')
                                ->description('Customize only the gateway pages.')
                                ->collapsible()
                                ->collapsed()
                                ->schema([
                                    Field::make('gateway_css')
                                        ->codeEditor()
                                        ->label('Gateway CSS')
                                        ->language('css'),

                                    Field::make('gateway_js')
                                        ->codeEditor()
                                        ->label('Gateway JavaScript')
                                        ->language('javascript'),
                                ]),

                            Section::make('payment_link_page_code')
                                ->label('Payment Link Page Code')
                                ->description('Customize only the payment link pages.')
                                ->collapsible()
                                ->collapsed()
                                ->schema([
                                    Field::make('payment_link_css')
                                        ->codeEditor()
                                        ->label('Payment Link CSS')
                                        ->language('css'),

                                    Field::make('payment_link_js')
                                        ->codeEditor()
                                        ->label('Payment Link JavaScript')
                                        ->language('javascript'),
                                ]),
                        ]),
                ])
                ->columnSpanFull()
                ->persistTabInQueryString()
                ->contained(false),
        ]);
    }
}
