<x-filament::section>
    <x-slot name="description">
        Follow these instructions to set up the gateway on your Shopify Store.
    </x-slot>

    <ul class="list-disc space-y-1 pl-5 text-sm text-gray-600">
        <li>
            In your
            <strong>Shopify Partner Dev Dashboard</strong>
            open
            <strong>Apps → Create app</strong>
            and create a new custom app.
        </li>
        <li>
            From the app's
            <strong>Settings</strong>
            page copy the
            <strong>Client ID</strong>
            and
            <strong>Secret</strong>
            into the fields below. Client Secret is shown only once.
        </li>
        <li>
            Enter your
            <strong>Shop Domain</strong>
            (for example
            <code>mystore.myshopify.com</code>
            ) without
            <code>https://</code>
            . The system exchanges your credentials for an access token automatically.
        </li>
        <li>
            Generate an
            <strong>App Automation Token</strong>
            for the app (App Management API). Keep it ready — you will need it in the next step.
        </li>
        <li>
            Save this gateway, then use the
            <strong>Deploy</strong>
            action on its row and paste the
            <strong>App Automation Token</strong>
            . We build and release the latest app version — including the checkout extension — to your store
            automatically. Progress shows at the top of the page.
        </li>
        <li>
            In your Shopify admin open
            <strong>Settings → Checkout → Customize</strong>
            , switch to the
            <strong>Thank You</strong>
            page, and add the
            <strong>UddoktaPay</strong>
            block.
        </li>
        <li>
            Paste the generated
            <strong>Checkout URL</strong>
            below into the deployed
            <strong>Thank You</strong>
            block's
            <strong>Checkout URL</strong>
            setting and save.
        </li>
        <li>
            Finally, create a
            <strong>manual payment method</strong>
            in Shopify under
            <strong>Settings → Payments → Manual payment methods</strong>
            so customers can place orders that route through UddoktaPay.
        </li>
    </ul>
</x-filament::section>
