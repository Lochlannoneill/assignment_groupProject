package com.example.myapplication;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.recyclerview.widget.RecyclerView;

public class RecyclerviewAdapterInstrument extends RecyclerView.Adapter<RecyclerviewAdapterInstrument.ViewHolder>{

//    Context context;
    String[] instruments, instruments_prices, instruments_codes;
    int[] instruments_images;
    private LayoutInflater layoutInflater;

    public RecyclerviewAdapterInstrument(String[] i, String[] ip, String[] ic, int[] img){
//        context = ctxt;
        instruments = i;
        instruments_prices = ip;
        instruments_codes = ic;
        instruments_images = img;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
//        layoutInflater = LayoutInflater.from(context);
        layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.row_product, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, final int index) {
        holder.text_product_name.setText(instruments[index]);
        holder.text_product_price.setText(instruments_prices[index]);
        holder.text_product_code.setText(instruments_codes[index]);
        holder.image_product.setImageResource(instruments_images[index]);
//        holder.layout.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent intent = new Intent(context, SecondActivity.class);
//                intent.putExtra("name", names[index]);
//                intent.putExtra("fact", facts[index]);
//                intent.putExtra("image", images[index]);
//                intent.putExtra("url", urls[index]);
//                context.startActivity(intent);
//            }
//        });

    }

    @Override
    public int getItemCount() {
        return instruments.length;
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        TextView text_product_name, text_product_price, text_product_code;
        ImageView image_product;
        ConstraintLayout layout;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            text_product_name = itemView.findViewById(R.id.product_name);
            text_product_price = itemView.findViewById(R.id.product_price);
            text_product_code = itemView.findViewById(R.id.product_code);
            image_product = itemView.findViewById(R.id.product_image);
            layout = itemView.findViewById(R.id.layout);
        }
    }

}
