package com.example.myapplication;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.recyclerview.widget.RecyclerView;

public class RecyclerviewAdapterGrocery extends RecyclerView.Adapter<RecyclerviewAdapterGrocery.ViewHolder>{

    //    Context context;
    String[] groceries, groceries_prices, groceries_codes;
    int[] groceries_images;
    private LayoutInflater layoutInflater;

    public RecyclerviewAdapterGrocery(String[] f, String[] fp, String[] fc, int[] img){
//        context = ctxt;
        groceries = f;
        groceries_prices = fp;
        groceries_codes = fc;
        groceries_images = img;
    }

    @NonNull
    @Override
    public RecyclerviewAdapterGrocery.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
//        layoutInflater = LayoutInflater.from(context);
        layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.row_product, parent, false);
        return new RecyclerviewAdapterGrocery.ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull RecyclerviewAdapterGrocery.ViewHolder holder, final int index) {
        holder.text_product_name.setText(groceries[index]);
        holder.text_product_price.setText(groceries_prices[index]);
        holder.text_product_code.setText(groceries_codes[index]);
        holder.image_product.setImageResource(groceries_images[index]);
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
        return groceries.length;
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
