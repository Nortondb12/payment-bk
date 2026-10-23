<x-mail::message>
# Hello {{ $invoice->getCustomerName() }},

Thank you for your payment! We have successfully received and processed your payment for the following invoice.

**Invoice Number:** #{{ $invoice->id }}  

## Items

@foreach($invoice->items as $item)
@php
    $itemLine = $item->quantity . ' × ' . $invoice->currency . ' ' . amount((string) $item->amount);
    
    if($item->discount && bccomp((string) $item->discount, '0', 8) > 0) {
        $itemLine .= ' • Discount: ' . $invoice->currency . ' ' . amount((string) $item->discount);
    }
    
    if($item->vat && bccomp((string) $item->vat, '0', 8) > 0) {
        $itemLine .= ' • VAT: ' . $item->vat . '%';
    }
    
    $itemLine .= ' = **' . $invoice->currency . ' ' . amount($item->totalAmount()) . '**';
@endphp

**{{ $loop->iteration }}. {{ $item->description ?? 'Item' }}**  
{!! $itemLine !!}

@endforeach

---

**Subtotal:** {{ $invoice->currency }} {{ amount($invoice->sub_total) }}

@if(bccomp($invoice->discount, '0', 8) > 0)
**Discount:** -{{ $invoice->currency }} {{ amount($invoice->discount) }}
@endif

@if(bccomp((string) $invoice->shipping_amount, '0', 8) > 0)
**Shipping:** {{ $invoice->currency }} {{ amount((string) $invoice->shipping_amount) }}
@endif

@if(bccomp($invoice->vat, '0', 8) > 0)
**VAT:** {{ $invoice->currency }} {{ amount($invoice->vat) }}
@endif

**Total Paid:** {{ $invoice->getFormattedAmount() }}

---

If you have any questions about this payment or need a receipt, please don't hesitate to contact our support team.

Thanks,<br>
{{ app_name() }}
</x-mail::message>