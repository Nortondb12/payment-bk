<?php

declare(strict_types=1);

namespace Themes\DefaultTheme;

use Revoltify\Support\Forms\Components\Field;
use Revoltify\Support\Forms\Components\Grid;
use Revoltify\Support\Forms\Components\Section;
use Revoltify\Support\Forms\Components\Tab;
use Revoltify\Support\Forms\Components\Tabs;
use Revoltify\Support\Forms\Form;
use Revoltify\Themeify\AbstractTheme;

final class Config extends AbstractTheme
{
    public function name(): string
    {
        return 'Default Theme';
    }

    public function description(): string
    {
        return 'A clean and modern default theme with customizable options';
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

    public function form(): Form
    {
        return Form::make([
            Tabs::make('theme_tabs')
                ->tabs([
                    Tab::make('general')
                        ->label('General')
                        ->icon('heroicon-o-cog')
                        ->schema([
                            Section::make('general_settings')
                                ->label('General Settings')
                                ->schema([
                                    Grid::make('gateway_display_mode_grid', 2)
                                        ->schema([
                                            Field::make('gateway_display_mode')
                                                ->select()
                                                ->label('Gateway Display Mode')
                                                ->options([
                                                    'all' => 'Show All Gateways',
                                                    'grouped' => 'Group Gateways by Type',
                                                ])
                                                ->default('grouped')
                                                ->helperText('Choose how payment gateways are displayed on the checkout page.'),
                                        ]),
                                ]),
                        ]),
                    Tab::make('colors')
                        ->label('Colors')
                        ->icon('heroicon-o-swatch')
                        ->schema([
                            Section::make('global_colors')
                                ->label('Global Colors')
                                ->description('Base color settings applied throughout the application.')
                                ->schema([
                                    Grid::make('global_colors_grid', 2)
                                        ->schema([
                                            Field::make('text_color')
                                                ->color()
                                                ->label('Text Color')
                                                ->helperText('Default color for general text elements'),
                                        ]),
                                ]),

                            Section::make('buttons')
                                ->label('Buttons')
                                ->description('Customize primary button styles')
                                ->collapsible()
                                ->schema([
                                    Grid::make('buttons_grid', 2)
                                        ->schema([
                                            Field::make('button_background_color')
                                                ->color()
                                                ->label('Button Background')
                                                ->helperText('Background color for primary buttons'),

                                            Field::make('button_text_color')
                                                ->color()
                                                ->label('Button Text')
                                                ->helperText('Text color for primary buttons'),

                                            Field::make('button_hover_background_color')
                                                ->color()
                                                ->label('Button Hover Background')
                                                ->helperText('Background color when hovering'),

                                            Field::make('button_hover_text_color')
                                                ->color()
                                                ->label('Button Hover Text')
                                                ->helperText('Text color when hovering'),
                                        ]),
                                ]),

                            Section::make('navigation')
                                ->label('Navigation')
                                ->description('Customize navigation bar and tab colors')
                                ->collapsible()
                                ->schema([
                                    Grid::make('navigation_grid', 2)
                                        ->schema([
                                            Field::make('navigation_background_color')
                                                ->color()
                                                ->label('Main Navigation Background')
                                                ->helperText('Background color for navigation bar'),

                                            Field::make('navigation_text_color')
                                                ->color()
                                                ->label('Main Navigation Text')
                                                ->helperText('Default text color in navigation'),

                                            Field::make('navigation_active_tab_background_color')
                                                ->color()
                                                ->label('Active Tab Background')
                                                ->helperText('Background for selected tab'),

                                            Field::make('navigation_active_tab_text_color')
                                                ->color()
                                                ->label('Active Tab Text')
                                                ->helperText('Text color for selected tab'),

                                            Field::make('navigation_footer_background_color')
                                                ->color()
                                                ->label('Footer Navigation Background')
                                                ->helperText('Background color for footer navigation'),

                                            Field::make('navigation_footer_text_color')
                                                ->color()
                                                ->label('Footer Navigation Text')
                                                ->helperText('Default text color in footer navigation'),
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
                                        ->language('css')
                                        ->helperText('Raw CSS only.'),

                                    Field::make('checkout_js')
                                        ->codeEditor()
                                        ->label('Checkout JavaScript')
                                        ->language('javascript')
                                        ->helperText('Raw JavaScript only.'),
                                ]),

                            Section::make('gateway_page_code')
                                ->label('Gateway Page Code')
                                ->description('Customize only the gateway page.')
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
                                ->description('Customize only the payment link page.')
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
